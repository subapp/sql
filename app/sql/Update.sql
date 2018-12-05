UPDATE
Ignore Quick
    `users` U
SET
`country`='Ukraine', U.city='Kyiv',
u.id=MAX(Distinct u.id) + 1
