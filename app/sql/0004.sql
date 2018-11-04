select
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
from `users`

