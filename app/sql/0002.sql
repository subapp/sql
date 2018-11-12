select
*,
`users`.*,
Count(user_id) cnt
from `users`