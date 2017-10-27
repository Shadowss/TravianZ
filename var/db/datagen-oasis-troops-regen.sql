-- ----------------------------------------------------------------------------------------
-- oasis regeneration script
-- used during installation, server reset, oasis reset & automation (nature repopulation)
-- 
-- author: martinambrus
-- ----------------------------------------------------------------------------------------


-- Nature regeneration time.
-- 
-- type:        int
-- description: when > -1, used to update the last oasis reset time (Automation nature regeneration)
--               when == -1, used to reset oasis data into original state (conquered > unoccupied)

SET @natureRegTime = %NATURE_REG_TIME%;



-- Oasis village ID.
--
-- type:        int
-- description: when > -1, used to regenerate units of a single oasis (when conquered > unoccupied)
--               when == -1, installation or server reset in progress, all oasis data are updated

SET @village = %VILLAGEID%;


-- minimum and maximum number of units for oasis with "high" field set to 0
SET @minUnitsForOasis0 = 15;
SET @maxUnitsForOasis0 = 30;

-- minimum and maximum number of units for oasis with "high" field set to 1
SET @minUnitsForOasis1 = 50;
SET @maxUnitsForOasis1 = 70;

-- minimum and maximum number of units for oasis with "high" field set to 2
SET @minUnitsForOasis2 = 90;
SET @maxUnitsForOasis2 = 120;



-- ----------------------------------------
-- reset oasis data (conquered > unoccupied)
-- ------------------------------------------
UPDATE %PREFIX%odata
    SET
        conqured = 0,
        wood = 800,
        iron = 800,
        clay = 800,
        maxstore = 800,
        crop = 800,
        maxcrop = 800,
        lastupdated = UNIX_TIMESTAMP(),
        lastupdated2 = UNIX_TIMESTAMP(),
        loyalty=100,
        owner=2,
        name='Unoccupied Oasis'
    WHERE
        @natureRegTime = -1
        AND
        (
            (
                -- should we have a list of IDs, we need to use FIND_IN_SET
                LOCATE(",", @village) > 0
                AND
                FIND_IN_SET(conqured, @village)
            )
            OR
            (
                -- for a single ID, we use a simple condition which can definitely use an index as well
                conqured = @village
            )
        );

-- ---------------------------------------------
-- remove past reports (conquered > unoccupied)
-- ---------------------------------------------
DELETE FROM %PREFIX%ndata
    WHERE
        @natureRegTime = -1
        AND
        (
            (
                -- should we have a list of IDs, we need to use FIND_IN_SET
                LOCATE(",", @village) > 0
                AND
                FIND_IN_SET(toWref, @village)
            )
            OR
            (
                -- for a single ID, we use a simple condition which can definitely use an index as well
                toWref = @village
            )
        );


-- ----------------------------------------------------------------
-- update next regeneration time (Automation, nature regeneration)
-- ----------------------------------------------------------------
UPDATE
    %PREFIX%odata
SET
    lastupdated2 = UNIX_TIMESTAMP() + @natureRegTime
WHERE
    @natureRegTime > -1
    AND
    (
        (
            -- should we have a list of IDs, we need to use FIND_IN_SET
            LOCATE(",", @village) > 0
            AND
            FIND_IN_SET(wref, @village)
        )
        OR
        (
            -- for a single ID, we use a simple condition which can definitely use an index as well
            wref = @village
        )
    );


-- -----------------------------------------------------------------------
-- update number of units depending on the oasis type                  --
-- the more lucrative the oasis is, the better defense will it get :-P --
-- -----------------------------------------------------------------------


-- +25% lumber oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u.u35 = u.u35 + (FLOOR(5 + RAND() * 10)),
        u36 = u36 + (FLOOR(0 + RAND() * 5)),
        u37 = u37 + (FLOOR(0 + RAND() * 5))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(1,2)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND
        (
            u35 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
            OR u36 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
            OR u37 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
        );

-- +25% lumber and +25% crop oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u35 = u35 + (FLOOR(5 + RAND() * 15)),
        u36 = u36 + (FLOOR(0 + RAND() * 5)),
        u37 = u37 + (FLOOR(0 + RAND() * 5)),
        u38 = u38 + (FLOOR(0 + RAND() * 5)),
        u40 = u40 + (FLOOR(0 + RAND() * 3))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(3)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND
        (
            u36 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
            OR u37 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
            OR u38 <= (
                CASE o.high
                    WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                    WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                    WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
                END
            )
        );

-- +25% clay oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(10 + RAND() * 15)),
        u32 = u32 + (FLOOR(5 + RAND() * 15)),
        u35 = u35 + (FLOOR(0 + RAND() * 10))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(4,5)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u32 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u35 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );

-- +25% clay and +25% crop oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(15 + RAND() * 20)),
        u32 = u32 + (FLOOR(10 + RAND() * 15)),
        u35 = u35 + (FLOOR(0 + RAND() * 10)),
        u40 = u40 + (FLOOR(0 + RAND() * 3))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(6)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u32 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u35 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );

-- +25% iron oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(10 + RAND() * 15)),
        u32 = u32 + (FLOOR(5 + RAND() * 15)),
        u34 = u34 + (FLOOR(0 + RAND() * 10))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(7,8)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u32 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u34 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );

-- +25% iron and +25% crop oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(15 + RAND() * 20)),
        u32 = u32 + (FLOOR(10 + RAND() * 15)),
        u34 = u34 + (FLOOR(0 + RAND() * 10)),
        u39 = u39 + (FLOOR(0 + RAND() * 3))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(9)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u32 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u34 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );

-- +25% crop oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(5 + RAND() * 15)),
        u33 = u33 + (FLOOR(5 + RAND() * 10)),
        u37 = u37 + (FLOOR(0 + RAND() * 10)),
        u38 = u38 + (FLOOR(0 + RAND() * 5)),
        u39 = u39 + (FLOOR(0 + RAND() * 5))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(10,11)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u33 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u37 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u38 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );

-- +50% crop oasis
UPDATE %PREFIX%units u
    JOIN %PREFIX%odata o
    ON u.vref = o.wref
    SET
        u31 = u31 + (FLOOR(10 + RAND() * 15)),
        u33 = u33 + (FLOOR(5 + RAND() * 10)),
        u37 = u37 + (FLOOR(0 + RAND() * 10)),
        u38 = u38 + (FLOOR(0 + RAND() * 5)),
        u39 = u39 + (FLOOR(0 + RAND() * 5)),
        u40 = u40 + (FLOOR(0 + RAND() * 3))
    WHERE
        (
            (
                @village = -1
                AND
                vref IN(
                        SELECT
                            id
                        FROM
                            s1_wdata
                        WHERE
                            oasistype IN(12)
                )
            )
            OR
            (
                @village > -1
                AND
                (
                    (
                        -- should we have a list of IDs, we need to use FIND_IN_SET
                        LOCATE(",", @village) > 0
                        AND
                        FIND_IN_SET(vref, @village)
                    )
                    OR
                    (
                        -- for a single ID, we use a simple condition which can definitely use an index as well
                        vref = @village
                    )
                )
            )
        )
        AND u31 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u33 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u37 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u38 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        )
        AND u39 <= (
            CASE o.high
                WHEN 0 THEN (FLOOR(@minUnitsForOasis0 + RAND() * @maxUnitsForOasis0))
                WHEN 1 THEN (FLOOR(@minUnitsForOasis1 + RAND() * @maxUnitsForOasis1))
                WHEN 2 THEN (FLOOR(@minUnitsForOasis2 + RAND() * @maxUnitsForOasis2))
            END
        );