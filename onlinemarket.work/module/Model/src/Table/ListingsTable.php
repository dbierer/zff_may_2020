<?php
namespace Model\Table;

use DateTime;
use DateInterval;
use Laminas\Db\Sql\Sql;
use Laminas\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway
{
    const TABLE_NAME = 'listings';
    public function findByCategory($category)
    {
        return $this->select(['category' => $category]);
    }
    public function findById($id)
    {
        return $this->select(['listings_id' => $id])->current();
    }
    public function findLatest()
    {
        $select = (new Sql($this->getAdapter()))->select();
        $select->from(self::TABLE_NAME)
               ->order('listings_id desc')
               ->limit(1);
        return $this->selectWith($select)->current();
    }
    public function save($data)
    {
        $data['date_expires'] = $this->getDateExpires($data['expires']);
        [$data['city'], $data['country']] = explode(',', $data['cityCode']);
        unset($data['expires']);
        unset($data['submit']);
        unset($data['cityCode']);
        unset($data['captcha']);
        return $this->insert($data);
    }
    protected function getDateExpires($expires)
    {
		if ($expires === 0) {
			$expires = 9999;
		}
        $now = new DateTime();
        $now = ($expires) ? $now->add(new DateInterval('P' . $expires . 'D')) : $now;
        return $now->format('Y-m-d H:i:s');
    }
}
