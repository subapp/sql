select t0.id,
 1 + 2 + 3  * 3 * 4
 from test t0

left join tableName t0 ON (t0.id != t1.subId or t1.id not in (5, 10, 20))
left join tableName t0 Using(t0.id, t1.subId)
left join
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
    order By 1 desc
    limit 1
) as y on x.CategoryID = y.CategoryID

where

a = 1 and b = 3 or c = 10 and d != 20
xor 1 !=2

GROUP by u.gid, StrToUpper(u.name)
order by t0.id desc , rand() asc, count (Distinct u.id) Desc

limit 100, 10