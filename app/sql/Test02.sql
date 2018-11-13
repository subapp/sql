SELECT
  (*)
FROM
  users AS U
  INNER JOIN tableName AS t0 ON (
    (
      (
        (
          (t0.cnt / 10) -3
        ) + 1
      ) = SUM(DISTINCT u.cnt)
      OR (
        ROUND(
          PI(),
          2
        ) = 3.14
        AND (
          (
            (t0.cnt / 10)
          ) + 3
        ) = 1
      )
    )
  )
WHERE
  (
    (
      (
        (t0.id / 10) + 3
      ) > 1
      AND (
        (
          (t0.subId / 10) + 3
        )
      ) > 1
    )
    OR (
      (
        (
          (u.id * 1 * 2)
        )
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
