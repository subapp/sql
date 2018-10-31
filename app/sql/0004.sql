select
(COUNT(di) / SQRT(12)) aaa,
10 one,
20 + 30 + 40 two,
(100 + 200) + 300 tri,
SUM(length(SQRT(s.name)) / count(s.id)),
COS(u.id) * 3,
2 * SIN(users.balance),
TAN(u.id),
(1 + 2) three,
sqrt(rand(100)) / count(s.id) + sum(s.balance) as tough,
sqrt((2 / 3) * rand(100)) * (123 + 777) / count(s.id) + sum(s.balance)
from `users`

