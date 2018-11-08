select
t0.name,
1 + 2 + 3 * 4 - 5 + 6 / 7,
10 + (20 + 30 * 40 - (50 + 60)) / 70,
sum(length(SQRT(s.name)) / count(s.id)),
Sum(u.id) * 3,
2 * Sum(users.balance),
cnt('test'),

t0.id from `users`
where a > 2