select t0.id,
(u.id  + 1 + 2 * 3)
 from test t0

Right join tableName t0 ON (t0.id <= t1.subId || t1.id >= 1) And 1 = 1
Inner join tableName t0 ON (t1.id / 1 - 2) > sum(Distinct U.cnt) and 1 > 2
Left join tableName t0 Using(t0.id, t1.subId)
left join
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
    order By 1 desc
    limit 1
) as y on x.CategoryID = y.CategoryID

where
(u.id * 1 * 2) > sum(Distinct U.cnt) and
(t0.id <= t1.subId || t1.id >= 1) or
(a = 1 and b = 3 Or c = 10 and d != 20)
xor 1 !=2

GROUP by u.gid, StrToUpper(u.name)
order by t0.id desc , rand() asc, count (Distinct u.id) Desc

limit 100, 10