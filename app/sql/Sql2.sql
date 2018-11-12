SELECT
  t0.id,
  (
    u.id + 1 + (2 * 3)
  )
FROM
  test AS t0
  RIGHT JOIN tableName AS t0 ON (
    (
      (
        t0.id <= t1.subId
        OR t1.id >= 1
      )
      AND 1 = 1
    )
  )
  INNER JOIN tableName AS t0 ON (
    (

        (t0.cnt / 10) + 3
       = SUM(DISTINCT u.cnt)
      OR ROUND(
        PI(),
        2
      ) = 3.14
    )
  )
  LEFT JOIN tableName AS t0 USING (t0.id, t1.subId)
  LEFT JOIN (
    SELECT
      a.CategoryID,
      b.CategoryName,
      AVG(a.UnitPrice) AS planned_unit_price
    FROM
      products
    ORDER BY
      1 DESC
    LIMIT
      1
  ) AS y ON (x.CategoryID = y.CategoryID)
WHERE
  (
    (
      (
        (u.id * 1 * 2)
      ) > SUM(DISTINCT U.cnt)
      AND (
        t0.id <= t1.subId
        OR t1.id >= 1
      )
    )
    OR (
      (
        a = 1
        AND b = 3
      )
      OR (
        c = 10
        AND d <> 20
      )
    )
    XOR 1 <> 2
  )
GROUP BY
  u.gid,
  STRTOUPPER(u.name)
ORDER BY
  t0.id DESC,
  RAND() ASC,
  COUNT(DISTINCT u.id) DESC
LIMIT
  100, 10
