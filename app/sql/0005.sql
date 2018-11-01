select y.CategoryID, 
    y.CategoryName,
    round(x.actual_unit_price, 2) as "Actual Avg Unit Price",
    round(y.planned_unit_price, 2) as "Would-Like Avg Unit Price"
from
(
    select avg(a.UnitPrice) as actual_unit_price, c.CategoryID
    from order_details as a
) as x
inner join 
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
) as y on x.CategoryID = y.CategoryID