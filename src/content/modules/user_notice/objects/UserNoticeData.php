<?php
class UserNoticeData extends User {
	protected $notice = null;
	const allowableTags = "<a><abbr><address><area><article><aside><audio><b><bdi><bdo><blockquote><br/><br><button><canvas><caption><cite><code><col><colgroup><command><data><datalist><dd><del><details><dfn><div><dl><dt><em><embed><fieldset><figcaption><figure><font><footer><form><header><hgroup><hr><i><iframe><img><input><ins><kbd><keygen><label><legend><li><map><mark><math><menu><meter><nav><object><ol><optgroup><option><output><p><param><pre><progress><q><rp><rt><ruby><s><samp><section><select><small><source><span><strong><sub><summary><sup><svg><table><tbody><td><textarea><tfoot><th><thead><time><tr><track><u><ul><var><video><wbr>";
	public function getNotice() {
		return $this->notice;
	}
	public function loadById($id) {
		parent::loadById ( $id );
		$sql = "select notice from {prefix}users where id = ?";
		$args = array (
				intval ( $id ) 
		);
		$query = Database::pQuery ( $sql, $args, true );
		$this->fillNoticeVar ( $query );
	}
	public function loadByUsername($name) {
		parent::loadByUsername ( $name );
		$sql = "select notice from {prefix}users where username = ?";
		$args = array (
				strval ( $name ) 
		);
		$query = Database::pQuery ( $sql, $args, true );
		$this->fillNoticeVar ( $query );
	}
	public function setNotice($val) {
		if (is_string ( $val )) {
			$this->notice = StringHelper::IsNotNullOrEmpty ( trim ( $val ) ) ? strip_tags ( $val, self::allowableTags ) : null;
		} else {
			$this->notice = null;
		}
	}
	// Notice aus Query in Klassenvariable schreiben
	private function fillNoticeVar($query) {
		throw new NotImplementedException ();
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