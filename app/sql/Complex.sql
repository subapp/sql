select
  1 - 2.0 + 3 + 4 * 5 * 6 + 7 * 8 + 1 / 2 - 3 + 7 test , 1 + (2 * 3) - 3 / 7 test2,
  1 + 1 test3, 1 * 1 * 1 test4,
  2 * 2 + 3 test5, 2 * 2 * 2 / 3 - 1 test6,
  1 + 2 / 2 / 2 / (2 / 3) / 2 - 1 test7, 1 + 2 + 3 * 5 + 1,
  user.id + 2 + t0.name As lala,
  Count(user_id), pi() pi, 3.14 float_pi, true, false, Null, (COUNT(s.id) / SQRT(12)) aaa, 10 one, 20 + 30 + 40 two,
  (100 + 200) + 300 tri, null, Sum(Distinct Length(SQRT(s.name)) / count(s.id)), COS(u.id) * 3, 2 * SIN(users.balance),
  TAN(u.id), (1 + 2) three, sqrt(rand(100)) / count(s.id) + sum(s.balance) as tough, (Select 123 int_type,
  1.23 float_type from innter_table) as sub_id, sqrt((2 / 3) * rand(100)) * (123 + 777) / count(s.id) + sum(s.balance)

from (Select 123 int_type, 1.23 float_type, 1 + 2 * 3 / (1 + 1) * 2 + 3 from innter_table) as t0

Right join tableName t0 ON (t0.id <= t1.subId || t1.id >= 1) And 1 = 1
Inner join tableName t0 ON (t0.cnt / 10 - 3) = sum(distinct u.cnt) || round(pi(), 2) = 3.14
Left join tableName t0 Using(t0.id, t1.subId)
left join
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
    order By 1 desc
    limit 1
) as y on x.CategoryID = y.CategoryID


left join tableName t0 ON (t0.id != t1.subId or t1.id not in (5, 10, 20))
left join tableName t0 Using(t0.id, t1.subId)
left join
(
    select a.CategoryID, b.CategoryName, avg(a.UnitPrice) as planned_unit_price
    from products
    where
(a = 1 and b = 3 or c = 10 and d != 20)
xor
a <1 || b < 10 || z != 1 && b > 2 and c != 0 or d >=2 and a > 100 and c < 300 or f = 10 || e = 100
|| i in(select u.id from users u) and b in(1, 2, 3, 4, 5)
    order By 1 desc

    limit 1
) as y on x.CategoryID = y.CategoryID
where
(a = 1 and b = 3 or c = 10 and d != 20)
xor
a <1 || b < 10 || z != 1 && b > 2 and c != 0 or d >=2 and a > 100 and c < 300 or f = 10 || e = 100
&&
(u.id1 < 100 And u.create >= 1000000 aNd u.ia <= 100500)
|| ( activities.orderby = 1
      AND activities.starttime >= '2013-08-26 04:00:00'
      AND activities.endtime <= '2013-08-27 04:00:00' )
   Or
    u.login_cnt > (10 + sqrt((2 / 3) * rand(100)) * (123 + 777) / count(s.id) + sum(s.balance) * sum(u.test) / 2 + 1)
anD
  u.id < 100 and u.create >= 1000000
  &&
  u.login_cnt > (10 + 20 * sum(u.test) / 2 + 1)
  and
  u.name > 3 ||
(gateway not like '%pay-gw%' and u.name like 'test')
    AND (
      ( activities.orderby = 1
    AND activities.starttime >= '2013-08-26 04:00:00'
    AND activities.endtime <= '2013-08-27 04:00:00'
      )
    or ( activities.orderby != 1 AND activities.activitydate = '2013-08-26')
  )
&& 1 != 1 || 2 >= 1
ORDER  BY activitytypes.orderby,
     activities.starttime