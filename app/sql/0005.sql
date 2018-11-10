select y.CategoryID, 
    y.CategoryName,
    round(x.actual_unit_price, 2) as "Actual Avg Unit Price",
    round(y.planned_unit_price, 2) as "Would-Like Avg Unit Price"
from
(
    select avg(a.UnitPrice) as actual_unit_price, c.CategoryID
    from order_details as a
) as x
left join tableName t0 ON (t0.id != t1.subId or t1.id not in (5, 10, 20))
left join tableName t0 Using(t0.id, t1.subId)
left join
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
) as y on x.CategoryID = y.CategoryID
where
(a = 1 and b = 3 or c = 10 and d != 20)
xor
a <1 || b < 10 || z != 1 && b > 2 and c != 0 or d >=2 and a > 100 and c < 300 or f = 10 || e = 100 || i in(select u.id from users u) and b in(1, 2, 3, 4, 5)