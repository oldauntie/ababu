-- START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ababu`
--

--
-- Dump table `prescriptions`
--

-- INSERT INTO `prescriptions` (`problem_id`, `medicine_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES
-- (1, '10347/4037', 1, 1, 'one per day..', 0, '2018-09-11 17:57:22', '2018-10-19 14:54:10'),
-- (6, '10347/4037', 1, 1, 'one a day...', 1, '2018-09-13 08:46:00', '2019-03-23 13:43:22'),
-- (7, '32742/4005', 1, 1, '1', 1, '2018-09-18 14:43:23', '2019-03-23 13:43:12'),
-- (8, 'EU/2/08/088/004', 1, 1, 'one or two a day', 0, '2018-10-08 10:27:07', '2019-03-22 09:01:49'),
-- (9, '41821/4019', 1, 3, 'one per day', 0, '2018-10-29 13:15:51', '2019-03-23 13:39:43'),
-- (1, '00879/4011', 2, 1, 'one', 0, '2018-11-01 12:13:34', NULL),
-- (3, '10347/4037', 1, 1, 'r', 1, '2018-11-01 13:16:11', '2018-12-21 15:11:42'),
-- (4, 'EU/2/10/118/001-002,015', 2, 1, 'one a day', 0, '2018-11-07 09:36:59', NULL),
-- (5, '47367/4000', 1, 1, 'one a week', 0, '2018-11-20 10:45:21', '2019-03-20 22:24:25'),
-- (6, '03940/4074', 1, 1, 'a dosage', 0, '2018-12-21 14:30:57', '2019-01-07 19:39:29');
-- COMMIT;

INSERT INTO `prescriptions` (`id`, `medicine_id`, `problem_id`, `pet_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES(1, '1', 1, 1, 1, 1, 'one a day', 1, '2020-08-02 22:00:00', NULL);
INSERT INTO `prescriptions` (`id`, `medicine_id`, `problem_id`, `pet_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES(2, '2', 2, 1, 2, 3, 'when needed', 0, '2020-03-16 23:00:00', NULL);
INSERT INTO `prescriptions` (`id`, `medicine_id`, `problem_id`, `pet_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES(3, '2', 2, 1, 2, 3, 'repeat once a week', 0, '2020-09-04 22:00:05', NULL);
INSERT INTO `prescriptions` (`id`, `medicine_id`, `problem_id`, `pet_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES(4, '3', NULL, 1, 2, 3, 'nullable', 1, '2020-09-04 22:00:05', NULL);
INSERT INTO `prescriptions` (`id`, `medicine_id`, `problem_id`, `pet_id`, `user_id`, `quantity`, `dosage`, `in_evidence`, `created_at`, `updated_at`) VALUES(5, '5', NULL, 1, 2, 1, 'just one', 1, '2017-07-22 22:00:05', NULL);
COMMIT;
