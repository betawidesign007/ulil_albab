-- SQLite Dump for database.sqlite
-- Generated on 2026-10-19 18:05:24

PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;

--
-- Table structure for migrations
--
DROP TABLE IF EXISTS "migrations";
CREATE TABLE "migrations" ("id" integer primary key autoincrement not null, "migration" varchar not null, "batch" integer not null);

--
-- Dumping data for migrations
--
INSERT INTO "migrations" ("id", "migration", "batch") VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO "migrations" ("id", "migration", "batch") VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO "migrations" ("id", "migration", "batch") VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');

--
-- Table structure for users
--
DROP TABLE IF EXISTS "users";
CREATE TABLE "users" ("id" integer primary key autoincrement not null, "name" varchar not null, "email" varchar not null, "email_verified_at" datetime, "password" varchar not null, "remember_token" varchar, "created_at" datetime, "updated_at" datetime);

--
-- Table structure for password_reset_tokens
--
DROP TABLE IF EXISTS "password_reset_tokens";
CREATE TABLE "password_reset_tokens" ("email" varchar not null, "token" varchar not null, "created_at" datetime, primary key ("email"));

--
-- Table structure for sessions
--
DROP TABLE IF EXISTS "sessions";
CREATE TABLE "sessions" ("id" varchar not null, "user_id" integer, "ip_address" varchar, "user_agent" text, "payload" text not null, "last_activity" integer not null, primary key ("id"));

--
-- Table structure for cache
--
DROP TABLE IF EXISTS "cache";
CREATE TABLE "cache" ("key" varchar not null, "value" text not null, "expiration" integer not null, primary key ("key"));

--
-- Table structure for cache_locks
--
DROP TABLE IF EXISTS "cache_locks";
CREATE TABLE "cache_locks" ("key" varchar not null, "owner" varchar not null, "expiration" integer not null, primary key ("key"));

--
-- Table structure for jobs
--
DROP TABLE IF EXISTS "jobs";
CREATE TABLE "jobs" ("id" integer primary key autoincrement not null, "queue" varchar not null, "payload" text not null, "attempts" integer not null, "reserved_at" integer, "available_at" integer not null, "created_at" integer not null);

--
-- Table structure for job_batches
--
DROP TABLE IF EXISTS "job_batches";
CREATE TABLE "job_batches" ("id" varchar not null, "name" varchar not null, "total_jobs" integer not null, "pending_jobs" integer not null, "failed_jobs" integer not null, "failed_job_ids" text not null, "options" text, "cancelled_at" integer, "created_at" integer not null, "finished_at" integer, primary key ("id"));

--
-- Table structure for failed_jobs
--
DROP TABLE IF EXISTS "failed_jobs";
CREATE TABLE "failed_jobs" ("id" integer primary key autoincrement not null, "uuid" varchar not null, "connection" varchar not null, "queue" varchar not null, "payload" text not null, "exception" text not null, "failed_at" datetime not null default CURRENT_TIMESTAMP);

COMMIT;
