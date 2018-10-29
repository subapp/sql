select
       s.id,
       s.name,
       "test" T,
       sum(length(s.name) + count(distinct s.id)),
       ((5 + ((1 + 2) * 2)) * 10),
       (count(t0.id) - count(distinct t0.id)) AS delta,
       length(s.name) + count(distinct s.id),
       1 + 2,
       (2 + 2),
       (sqrt((2 / 3) * rand(100)) * (123 + 0.777) / count(s.id) + sum(s.balance))

from `users` AS s;