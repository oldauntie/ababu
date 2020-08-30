--
-- Database: `ababu`
--

-- --------------------------------------------------------

--
-- Table structure for table `animalia`
--

CREATE TABLE `animalia` (
  `tsn` int(11) NOT NULL,
  `unit_ind1` char(1) DEFAULT NULL,
  `unit_name1` char(35) NOT NULL,
  `unit_ind2` char(1) DEFAULT NULL,
  `unit_name2` varchar(35) DEFAULT NULL,
  `unit_ind3` varchar(7) DEFAULT NULL,
  `unit_name3` varchar(35) DEFAULT NULL,
  `unit_ind4` varchar(7) DEFAULT NULL,
  `unit_name4` varchar(35) DEFAULT NULL,
  `unnamed_taxon_ind` char(1) DEFAULT NULL,
  `name_usage` varchar(12) NOT NULL,
  `unaccept_reason` varchar(50) DEFAULT NULL,
  `credibility_rtng` varchar(40) NOT NULL,
  `completeness_rtng` char(10) DEFAULT NULL,
  `currency_rating` char(7) DEFAULT NULL,
  `phylo_sort_seq` smallint(6) DEFAULT NULL,
  `initial_time_stamp` datetime NOT NULL,
  `parent_tsn` int(11) DEFAULT NULL,
  `taxon_author_id` int(11) DEFAULT NULL,
  `hybrid_author_id` int(11) DEFAULT NULL,
  `kingdom_id` smallint(6) NOT NULL,
  `rank_id` smallint(6) NOT NULL,
  `update_date` date NOT NULL,
  `uncertain_prnt_ind` char(3) DEFAULT NULL,
  `n_usage` text DEFAULT NULL,
  `complete_name` tinytext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animalia`
--
ALTER TABLE `animalia`
  ADD PRIMARY KEY (`tsn`),
  ADD KEY `taxon_unit_index1` (`tsn`,`parent_tsn`),
  ADD KEY `taxon_unit_index2` (`tsn`,`unit_name1`,`name_usage`),
  ADD KEY `taxon_unit_index3` (`kingdom_id`,`rank_id`),
  ADD KEY `taxon_unit_index4` (`tsn`,`taxon_author_id`);
COMMIT;
