SELECT DISTINCTROW SQL_SMALL_RESULT SQL_NO_CACHE 1 - 2.0 + 3 + 4 * 5 * 6 + 7 * 8 + 1 / 2 - 3 + 7                      AS test,
                                                 1 + 2 * 3 - 3 / 7                                                    AS test2,
                                                 1 + 1                                                                AS test3,
                                                 1 * 1 * 1                                                            AS test4,
                                                 2 * 2 + 3                                                            AS test5,
                                                 2 * 2 * 2 / 3 - 1                                                    AS test6,
                                                 1 + 2 / 2 / 2 / 2 / 3 / 2 - 1                                        AS test7,
                                                 1 + 2 + 3 * 5 + 1,
                                                 user.id + 2 + t0.name                                                AS lala,
                                                 COUNT(user_id),
                                                 PI()                                                                 AS pi,
                                                 3.14                                                                 AS float_pi,
                                                 TRUE,
                                                 TRUE,
                                                 NULL,
                                                 COUNT(s.id) + SQRT(12)                                               AS aaa,
                                                 MATCH(title,
                                                       body) AGAINST("~string -exclusion +test +test2 -test4")        AS selectVar,
                                                 10                                                                   AS one,
                                                 20 + 30 + 40                                                         AS two,
                                                 100 + 200 + 300                                                      AS tri,
                                                 NULL,
                                                 SUM(DISTINCT LENGTH(SQRT(s.name)) / COUNT(s.id)),
                                                 COS(u.id) * 3,
                                                 2 * SIN(users.balance),
                                                 TAN(u.id),
                                                 1 + 2                                                                AS three,
                                                 SQRT(RAND(100)) / COUNT(s.id) + SUM(s.balance)                       AS tough,
                                                 (SELECT 123 AS int_type, 1.23 AS float_type
                                                  FROM innter_table)                                                  AS sub_id,
                                                 SQRT(2 / 3 * RAND(100)) * 123 + 777 / COUNT(s.id) + SUM(s.balance)
FROM (SELECT 123 AS int_type, 1.23 AS float_type, 1 + 2 * 3 / 1 + 1 * 2 + 3 FROM innter_table) AS t0
       RIGHT JOIN tableName AS t0 ON ((t0.id <= t1.subId OR t1.id >= 1) AND 1 = 1)
       INNER JOIN tableName AS t0 ON ((t0.cnt / 10 - 3 = SUM(DISTINCT u.cnt) OR ROUND(PI(), 2) = 3.14))
       LEFT JOIN tableName AS t0 USING (t0.id, t1.subId)
       LEFT JOIN (SELECT a.CategoryID, b.CategoryName, AVG(a.UnitPrice) AS planned_unit_price
                  FROM products
                  ORDER BY 1 DESC
                  LIMIT 1) AS y ON (x.CategoryID = y.CategoryID)
       LEFT JOIN tableName AS t0 ON ((t0.id <> t1.subId OR t1.id NOT IN (5, 10, 20)))
       LEFT JOIN tableName AS t0 USING (t0.id, t1.subId)
       LEFT JOIN (SELECT a.CategoryID, b.CategoryName, AVG(a.UnitPrice) AS planned_unit_price
                  FROM products
                  WHERE ((a = 1 AND (b = 3 OR c = 10) AND d <> 20 XOR a <> 1) OR b < 10 OR z <> 1)
                    AND b > 2
                    AND (c <> 0 OR d >= 2)
                    AND a > 100
                    AND (c < 300 OR f = 10 OR e = 100 OR i IN(SELECT u.id FROM users AS u))
                    AND b IN (1, 2, 3, 4, 5)
                  ORDER BY 1 DESC
                  LIMIT 1) AS y ON (x.CategoryID = y.CategoryID)
WHERE ((a = 1 AND (b = 3 OR c = 10) AND d <> 20 XOR a < 1) OR b < 10 OR z <> 1)
  AND b > 2
  AND (c <> 0 OR d >= 2)
  AND a > 100
  AND (c < 300 OR f = 10 OR e = 100)
  AND (u.id1 < 100 AND u.create >= 1000000 AND u.ia <= 100500 OR
       activities.orderby = 1 AND activities.starttime >= '2013-08-26 04:00:00' AND
       activities.endtime <= '2013-08-27 04:00:00' OR
       u.login_cnt > 10 + SQRT(2 / 3 * RAND(100)) * 123 + 777 / COUNT(s.id) + SUM(s.balance) * SUM(u.test) / 2 + 1)
  AND u.id < 100
  AND u.create >= 1000000
  AND u.login_cnt > 10 + 20 * SUM(u.test) / 2 + 1
  AND (u.name > 3 OR gateway NOT LIKE '%pay-gw%' AND u.name LIKE 'test')
  AND (activities.orderby = 1 AND activities.starttime >= '2013-08-26 04:00:00' AND
       activities.endtime <= '2013-08-27 04:00:00' OR
       activities.orderby <> 1 AND activities.activitydate = '2013-08-26')
  AND (1 <> 1 OR 2 >= 1)
ORDER BY activitytypes.orderby ASC, activities.starttime ASC