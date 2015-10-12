DROP TABLE IF EXISTS `tb_session`;
CREATE TABLE IF NOT EXISTS `tb_session` (
  `id` int(11) NOT NULL,
  `session_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `session_finish` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_session_detail`
--

DROP TABLE IF EXISTS `tb_session_detail`;
CREATE TABLE IF NOT EXISTS `tb_session_detail` (
  `id` int(11) NOT NULL,
  `parentid` int(5) NOT NULL,
  `xpos` int(4) NOT NULL,
  `ypos` int(4) NOT NULL,
  `face` int(3) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;