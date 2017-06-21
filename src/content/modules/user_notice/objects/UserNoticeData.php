<?php
class UserNoticeData extends User {
	protected $notice = null;
	const allowableTags = "<a><abbr><address><area><article><aside><audio><b><bdi><bdo><blockquote><br/><br><button><canvas><caption><cite><code><col><colgroup><command><data><datalist><dd><del><details><dfn><div><dl><dt><em><embed><fieldset><figcaption><figure><font><footer><form><header><hgroup><hr><i><iframe><img><input><ins><kbd><keygen><label><legend><li><map><mark><math><menu><meter><nav><object><ol><optgroup><option><output><p><param><pre><progress><q><rp><rt><ruby><s><samp><section><select><small><source><span><strong><sub><summary><sup><svg><table><tbody><td><textarea><tfoot><th><thead><time><tr><track><u><ul><var><video><wbr>";
	public function getNotice() {
		return $this->notice;
	}
	public function setNotice($val) {
		if (is_string ( $val )) {
			$trimmed = trim ( strip_tags ( $val, "<img><table><a>" ) );
			if (StringHelper::isNotNullOrWhitespace ( $trimmed )) {
				$this->notice = strip_tags ( $val, self::allowableTags );
			} else {
				$this->notice = null;
			}
		} else {
			$this->notice = null;
		}
	}
	public function insert() {
		parent::insert ();
		$this->update ();
	}
	public function update() {
		parent::update ();
		$sql = "update {prefix}users set notice = ? where id = ?";
		$args = array (
				$this->getNotice (),
				$this->getId () 
		);
		Database::pQuery ( $sql, $args, true );
	}
}