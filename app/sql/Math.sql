select
  1 - 2.0 + 3 + 4 * 5 * 6 + 7 * 8 + 1 / 2 - 3 + 7 test ,
  1 + (2 * 3) - 3 / 7 test2,
  1 + 1 test3,
  1 * 1 * 1 test4,
  2 * 2 + 3 test5,
  2 * 2 * 2 / 3 - 1 test6,
  1 + 2 / 2 / 2 / (2 / 3) / 2 - 1 test7,
  1 + 2 + 3 * 5 + 1,
  user.id + 2 + t0.name As lala,
  Count(user_id),
  pi() pi,
  3.14 float_pi,
  true, false, Null,
  (COUNT(s.id) / SQRT(12)) aaa,
  10 one,
  20 + 30 + 40 two,
  (100 + 200) + 300 tri,
  null,
  Sum(Distinct Length(SQRT(s.name)) / count(s.id)),
  COS(u.id) * 3,
  2 * SIN(users.balance),
  TAN(u.id),
  (1 + 2) three,
  sqrt(rand(100)) / count(s.id) + sum(s.balance) as tough,
  (Select 123 int_type, 1.23 float_type from innter_table) as sub_id,
  sqrt((2 / 3) * rand(100)) * (123 + 777) / count(s.id) + sum(s.balance)

from (Select 123 int_type, 1.23 float_type, 1 + 2 * 3 / (1 + 1) * 2 + 3 from innter_table) as t0;