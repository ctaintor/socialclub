select
    su.*
from [_]member as me
    inner join [_]subscription as su on su.c_owner = me.c_uid
    inner join [_]membership as ms on ms.c_member = me.c_uid
    inner join [_]status as st on st.c_uid = ms.c_status
where st.c_title = 'active'
    and me.c_deleted <> 1
    and su.c_deleted <> 1
    and ms.c_deleted <> 1
group by me.c_uid
having max(ms.c_expiration_date) < current_date
