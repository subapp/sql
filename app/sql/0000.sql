select
t0.name,
1 + 2 + 3,
sum(length(sum(s.name)) / count(s.id)),
Sum(u.id) * 3,
2 * Sum(users.balance),
cnt('test'),
t0.id from `users`