-- Selects a list of all actions that the member is allowed to do on the object.
-- Takes into account both the UNIX style bitmasked privileges and the ACL
-- privileges that are stored in [_]privilege.
-- Parameters:
--      member: The UID of the member
--      object: The UID of the object
--      table:  The table the object lives in.  This parameter appears in both
--              char and none data types.
--      applies_to_object: flag
--      root_group: The UID of the root group
--      All of the various bitmasks from [_]unixperm.
select ac.*
    -- You could add columns to the select statement to show what granted the
    -- privilege, for instance group_owner.c_uid would show if the member is in
    -- the group that owns the object.
from
    [_]action as ac
    -- join onto the object itself
    inner join {table,none} as obj on obj.c_uid = {object,int}
    -- Filter out actions that do not apply to this object type
    inner join [_]implemented_action as ia
        on ia.c_action = ac.c_uid
            and (ia.c_table = {table,char} or ia.c_table = '')
    -- Privileges that apply to the object (or every object in the table)
    -- and grant the given action
    left outer join [_]privilege as pr
        on pr.c_related_table = {table,char}
            and pr.c_deleted <> 1
            and pr.c_action = ac.c_uid
            and (
                (pr.c_what_relates_to = 'object' and pr.c_related_uid = {object,int})
                or pr.c_what_relates_to = 'global'
                or (pr.c_what_relates_to = 'self' and {object,int} = {member,int} and {table,char} = '[_]member'))
    -- Groups that the member belongs to, which may be null if he doesn't belong
    -- to any
    left outer join [_]member_group as mg on mg.c_member = {member,int}
        and mg.c_deleted <> 1
    -- If this is not null, the member belongs to the group that owns the object
    left outer join [_]member_group as group_owner
        on group_owner.c_related_group = obj.c_group
        and group_owner.c_member = {member,int}
        and group_owner.c_deleted <> 1
where
    -- The action must apply to objects
    (ac.c_flags & {applies_to_object,int} <> 0)
    and obj.c_deleted <> 1
    and (
        -- Members of the 'root' group are always allowed to do everything
        mg.c_related_group = {root_group,int}
        -- UNIX style read permissions in the bit field
        or (ac.c_title = 'read' and (
            -- The other_read flag is on
            (obj.c_unixperms & {other_read,int} <> 0)
            -- The owner_read flag is on, and the member is the owner
            or ((obj.c_unixperms & {owner_read,int} <> 0) and obj.c_owner = {member,int})
            -- The group_read flag is on, and the member is in the group
            or ((obj.c_unixperms & {group_read,int} <> 0) and group_owner.c_uid is not null)))
        -- UNIX style write permissions in the bit field
        or (ac.c_title = 'write' and (
            -- The other_write flag is on
            (obj.c_unixperms & {other_write,int} <> 0)
            -- The owner_write flag is on, and the member is the owner
            or ((obj.c_unixperms & {owner_write,int} <> 0) and obj.c_owner = {member,int})
            -- The group_write flag is on, and the member is in the group
            or ((obj.c_unixperms & {group_write,int} <> 0) and group_owner.c_uid is not null)))
        -- UNIX style delete permissions in the bit field
        or (ac.c_title = 'delete' and (
            -- The other_delete flag is on
            (obj.c_unixperms & {other_delete,int} <> 0)
            -- The owner_delete flag is on, and the member is the owner
            or ((obj.c_unixperms & {owner_delete,int} <> 0) and obj.c_owner = {member,int})
            -- The group_delete flag is on, and the member is in the group
            or ((obj.c_unixperms & {group_delete,int} <> 0) and group_owner.c_uid is not null)))
        -- user privileges
        or (pr.c_what_granted_to = 'user' and pr.c_who_granted_to = {member,int})
        -- owner privileges
        or (pr.c_what_granted_to = 'owner' and obj.c_owner = {member,int})
        -- owner_group privileges
        or (pr.c_what_granted_to = 'owner_group' and group_owner.c_uid is not null)
        -- group privileges
        or (pr.c_what_granted_to = 'group' and pr.c_who_granted_to = mg.c_related_group))
order by ac.c_summary
