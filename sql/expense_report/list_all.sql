select
    re.*,
    coalesce(sum(ex.c_amount), 0.00) as total,
    st.c_title as status_title,
    me.c_full_name
from [_]expense_report as re
    left outer join [_]expense as ex on ex.c_report = re.c_uid
        and ex.c_deleted <> 1
    inner join [_]member as me on me.c_uid = re.c_member
    inner join [_]status as st on re.c_status = st.c_uid
where
    ({status,int} is null or re.c_status = {status,int})
    and ({begin,date} is null or re.c_created_date >= {begin,date})
    and ({end,date} is null or re.c_created_date <= {end,date})
    and ({leader,int} is null or re.c_member = {leader,int})
    and re.c_deleted <> 1
    and me.c_deleted <> 1
group by re.c_uid
