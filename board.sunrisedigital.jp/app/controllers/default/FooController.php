<?php

class FooController extends Sdx_Controller_Action_Http
{
    public function indexAction()
    {
        $this->_disableViewRenderer();
    }

    public function barAction()
    {
        $this->view->assign('date', date('Y-m-d H:i:s'));
    }

    public function dbAction()
    {
        $this->_disableViewRenderer();

        //接続を取得
        $db = Bd_Db::getConnection('board_master');

        //トランザクション開始
        $db->beginTransaction();

        //テーブル名を指定してINSERT文を生成・実行
        $db->insert('account', array(
            'login_id' => 'admin',
            'password' => 'kondo',
            'name'     => 'takayuki',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        $db->commit();

        //取得して確認
        Sdx_Debug::dump($db->query("SELECT * FROM account")->fetchAll(), 'title');
    }

    public function ormNewAction()
    {
        $this->_disableViewRenderer();

        //レコードクラスの生成
        $account = new Bd_Orm_Main_Account();

        $account
            ->setLoginId('test')
            ->setName('Test Name')
            ->setPassword('flkdjf0');

        //このレコードが使用する接続を取得
        $db = $account->updateConnection();

        $db->beginTransaction();
        $account->save();
        $db->commit();

        //取得して確認
        Sdx_Debug::dump($db->query("SELECT * FROM account")->fetchAll(), 'title');
    }

    public function ormSelectAction()
    {
        $this->_disableViewRenderer();

        //テーブルクラスの取得
        $t_account = Bd_Orm_Main_Account::createTable();

        //主キー１のレコードを取得
        $account = $t_account->findByPkey(1);

        //Selectの取得
        $select = $t_account->getSelect();

        //selectにWHERE句を追加　※idの値は適宜書き換えてください
        $select->add('id', array(1,3));

        //SQLを発行
        $list = $t_account->fetchAll($select);

        //toArray()はレコードの配列表現を取得するメソッドです。
        //Sdx_Debug::dump($account->toArray(), 'account2array');

        //fetchAllの返り値は配列ではなく Bd_Db_Record_Listのインスタンスです
        //Sdx_Debug::dump($list, 'list');

        //Record_Listの配列表現をdump
        //Sdx_Debug::dump($list->toArray(), 'list2array');

        //JOIN対象のテーブルを生成
        $t_entry = Bd_Orm_Main_Entry::createTable();

        //INNER JOIN
        $t_account->addJoinInner($t_entry);

        //selectを取得するメソッドがgetSelectWithJoinなので注意！
        $select = $t_account->getSelectWithJoin();

        //この結果はまだentryにレコードがないのでSQLだけ確認してください
        $list = $t_account->fetchAll($select);
    }

    public function ormUpdateAction()
    {
        $this->_disableViewRenderer();

        //テーブルクラスを取得
        $t_account = Bd_Orm_Main_Account::createTable();

        //主キー1のレコードを取得
        $account = $t_account->findByPkey(1);

        $account->setPassword('update_password_'.date('Y-m-d H:i:s'));

        $db = $account->updateConnection();

        $db->beginTransaction();
        $account->save();
        $db->commit();

        //取得して確認
        Sdx_Debug::dump($db->query("SELECT * FROM account")->fetchAll(), 'title');
    }

    public function ormDeleteAction()
    {
        $this->_disableViewRenderer();

        //テーブルクラスの取得
        $t_account = Bd_Orm_Main_Account::createTable();

        //主キー1レコードを取得
        $account = $t_account->findByPkey(1);

        $db = $account->updateConnection();

        $db->beginTransaction();
        $account->delete();
        $db->commit();

        //取得して確認
        Sdx_Debug::dump($db->query("SELECT * FROM account")->fetchAll(), 'title');
    }
}