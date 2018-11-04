select
Count(user_id)
from `users` u
LEFT JOIN `table0` t0 ON t0.`id` = u.user_id