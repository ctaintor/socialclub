select
    cg.c_uid,
    cg.c_qty,
    cg.c_description,
    ic.c_title as ic_title,
    it.c_title as it_title,
    st.c_title as st_title
from [_]checkout_gear as cg
    inner join [_]item_type as it on it.c_uid = cg.c_type
    inner join [_]item_category as ic on ic.c_uid = it.c_category
    inner join [_]status as st on st.c_uid = cg.c_status
where cg.c_checkout = {checkout,int}
    and cg.c_deleted <> 1
    and it.c_deleted <> 1
    and ic.c_deleted <> 1
    and ({status,int} is null or cg.c_status = {status,int})
order by ic.c_title, it.c_title
