-- generate world map data
INSERT INTO %PREFIX%wdata

    -- this select gets the right number of columns for the wdata table
    SELECT 0 as id, fieldtype, oasistype, x, y, 0 as occupied, image FROM

        -- this select prepares (i.e. generates) the world data
        (SELECT

            -- save a random number from 1 to 1000 into a variable
            @rnd := (FLOOR(1 + RAND() * 1000)),

            -- fieldtype is always 3 for the middle and the word border
            IF (
                (x = 0 AND y = 0) OR (x = %WORLDSIZE% AND y = %WORLDSIZE%),
                3,
                -- get a field type based on the random number previously generated
                CASE
                    WHEN @rnd <= 10 THEN @ftype := 1
                    WHEN @rnd <= 90 THEN @ftype := 2
                    WHEN @rnd <= 400 THEN @ftype := 3
                    WHEN @rnd <= 480 THEN @ftype := 4
                    WHEN @rnd <= 560 THEN @ftype := 5
                    WHEN @rnd <= 570 THEN @ftype := 6
                    WHEN @rnd <= 600 THEN @ftype := 7
                    WHEN @rnd <= 630 THEN @ftype := 8
                    WHEN @rnd <= 660 THEN @ftype := 9
                    WHEN @rnd <= 740 THEN @ftype := 10
                    WHEN @rnd <= 820 THEN @ftype := 11
                    WHEN @rnd <= 900 THEN @ftype := 12
                    WHEN @rnd <= 1000 THEN @ftype := 0
                END
            ) as fieldtype,

            -- there are no oasis' in the middle and by the word border
            IF (
                (x = 0 AND y = 0) OR (x = %WORLDSIZE% AND y = %WORLDSIZE%),
                0,
                -- get an oasis type if the field type generated in the previous IF statement
                -- is 0, based on the random number previously generated
                CASE
                    WHEN @ftype > 0 THEN @otype := 0
                    WHEN @rnd <= 908 THEN @otype := 1
                    WHEN @rnd <= 916 THEN @otype := 2
                    WHEN @rnd <= 924 THEN @otype := 3
                    WHEN @rnd <= 932 THEN @otype := 4
                    WHEN @rnd <= 940 THEN @otype := 5
                    WHEN @rnd <= 948 THEN @otype := 6
                    WHEN @rnd <= 956 THEN @otype := 7
                    WHEN @rnd <= 964 THEN @otype := 8
                    WHEN @rnd <= 972 THEN @otype := 9
                    WHEN @rnd <= 980 THEN @otype := 10
                    WHEN @rnd <= 988 THEN @otype := 11
                    ELSE @otype := 12
                END
            ) as oasistype,

            -- x and y coordinates come from the subqueries below
            x, y,

            -- create a random image name for the field or the oasis square
            IF (@otype = 0, CONCAT("t", (FLOOR(0 + RAND() * 9)) ), CONCAT("o", @otype) ) as image
        FROM

            -- the following select will generate a number from -%WORLDSIZE% to +%WORLDSIZE% as an X coordinate
            -- (courtesy of Unreason, https://stackoverflow.com/a/2652051/467164)
            -- this first line will keep incrementing @row until we run out of all the data provided by the "t" subselects below
            (SELECT @row := @row + 1 as x FROM 

            -- t and t2 each contain 10 rows of dummy data,
            -- cartesian product of these is 10^4, i.e. 10000 rows of dummy data
            -- and the outer select is just mysql version of rownumber
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t,
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,

            -- in t3, we only need 9 rows of dummy data, as 400 is currently the maximum allowed map size (i.e. -400 to +400)
            -- which brings us to `t1` x `t2` x `t3` = 10 x 10 x 9 = 900 (we need 900 not 800 because coordinates start at 0,0 not 1,1)
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8) t3,

            -- here we tell MySQL where to start, so if we have a world 100x100, this will set @row to -101
            -- (not -100 because the first select already increments the @row by 1, so we'd start at -99 instead)
            (SELECT @row := (-%WORLDSIZE% - 1)) as beginning
            ) as x,

            -- this query is the same as previous query for X coordinate but will generate numbers
            -- for the Y coordinate - both of these joined together this way will generate data such as:
            -- -100, 100; -99, 100; -98, 100 ...
            (SELECT @row2 := @row2 - 1 as y FROM 
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t,
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
            (select 0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8) t3,
            (SELECT @row2 := (%WORLDSIZE% + 1)) as beginning
            ) as y
        WHERE
            x BETWEEN -%WORLDSIZE% AND %WORLDSIZE%
            AND
            y BETWEEN -%WORLDSIZE% AND %WORLDSIZE%
        ) as generator;



-- populate oasis data
INSERT INTO %PREFIX%odata
    SELECT
        -- automatic ID
        id,
        -- type of oasis from wdata table
        oasistype,
        -- oasis is not conquered
        0,
        -- wood
        800,
        -- iron
        800,
        -- clay
        800,
        -- maximum storage for the 3 resources above
        800,
        -- crop
        800,
        -- maximum storage for crop
        800,
        -- last updated timestamps
        UNIX_TIMESTAMP(),
        UNIX_TIMESTAMP(),
        -- loyalty (100%)
        100,
        -- owner (2 = Nature)
        2,
        -- name for this square
        "Unoccupied Oasis",
        -- how many units would be (re)generated for this oasis, based on its type
        CASE
            WHEN oasistype < 4 THEN 1
            WHEN oasistype < 10 THEN 2
            ELSE 0
        END
    FROM
        %PREFIX%wdata
    WHERE
        oasistype <> 0;



-- create some defensive units for existing oasis
INSERT INTO %PREFIX%units (vref)
    SELECT
        id
    FROM
        %PREFIX%wdata
    WHERE
        oasistype <> 0;