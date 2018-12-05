UPDATE
Ignore Quick LOW_PRIORITY
    `users` U
SET
`country`='Ukraine', U.city='Kyiv',
u.id=MAX(Distinct u.id) + 1
WHERE a > 1 && (b > 3) || a in(1, 2,3 ) && z != Min(U.id)
anD
  u.id < 100 and u.create >= 1000000
  &&
  u.login_cnt > (10 + 20 * sum(u.test) / 2 + 1)
  and
  u.name > 3 ||
(gateway not like '%pay-gw%' and u.name like 'test')
    AND (
      ( activities.orderby = 1
    AND activities.starttime >= '2013-08-26 04:00:00'
    AND activities.endtime <= '2013-08-27 04:00:00'
      )
    or ( activities.orderby != 1 AND activities.activitydate = '2013-08-26')
  )
&& 1 != 1 || 2 >= 1
ORDER  BY activitytypes.orderby,
     activities.starttime
