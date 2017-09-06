<?php
namespace App\Models\Home;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    public function paixu($data,$page,$num)
    {
        $offset=($page-1)*5;
        switch ($data)
        {
            case 0:
                $rest=Db::select("SELECT * FROM ticket LEFT JOIN (SELECT min(price),ticket_id FROM ticket_price GROUP BY ticket_id) b1 ON b1.ticket_id = ticket.ticket_id limit $offset,$num");
                break;
            case 1:
                $rest=Db::select("SELECT * FROM ticket LEFT JOIN (SELECT min(price),ticket_id FROM ticket_price GROUP BY ticket_id) b1 ON b1.ticket_id = ticket.ticket_id where ticket.label='最新' limit $offset,$num");
                break;
            case 2:
                $rest=Db::select("SELECT * FROM ticket LEFT JOIN (SELECT min(price),ticket_id FROM ticket_price GROUP BY ticket_id) b1 ON b1.ticket_id = ticket.ticket_id where ticket.label='热门' limit $offset,$num");
                break;
            default:
                $rest=Db::select("SELECT * FROM ticket LEFT JOIN (SELECT min(price),ticket_id FROM ticket_price GROUP BY ticket_id) b1 ON b1.ticket_id = ticket.ticket_id limit $offset,$num");
                break;
        }
        return $rest;
    }
}