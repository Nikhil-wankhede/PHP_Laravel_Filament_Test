-- To optimize the performance of this query, you can create an index on the combination of the status and created_at columns. 
-- This will allow the database to quickly locate the relevant rows and sort them efficiently.

CREATE INDEX idx_orders_status_created_at ON orders (status, created_at DESC);

-- This index will store the values of the status column first, and then the values of the 
-- created_at column in descending order. This means that when the query is executed, 
-- the database can quickly find the rows with status = 'pending' and then retrieve them 
-- in the desired order without having to perform a full table scan and sort.


-- After creating the index, the query should run significantly faster, especially as the number of records in the table grows.

-- Additionally, you can consider the following optimizations:

-- 1. Covering Index: If you only need the columns present in the index (status and created_at) for your query, you can create a covering index by including those columns in the index definition. This can further improve performance by avoiding lookups in the main table.

-- 2. Partition Table: If your orders table grows very large, you may want to consider partitioning the table based on the created_at column. This can improve performance by allowing the database to access only the relevant partitions for the query.

-- 3. Denormalization: If you frequently run queries on the orders table and need to join with other tables, you may consider denormalizing the data by including relevant columns from other tables in the orders table. This can reduce the need for expensive joins and improve query performance.

-- 4. Query Optimization: Analyze the execution plan of your query using the EXPLAIN statement to identify potential bottlenecks and make adjustments accordingly.

-- 5. Caching: If the data in the orders table doesn't change frequently, you can consider caching the query results to avoid querying the database for every request.