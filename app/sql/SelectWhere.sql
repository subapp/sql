select u.id
from `users` u
where
(sum(u.login) + 1 * 2 + 2) < 100 and u.create >= 1000000