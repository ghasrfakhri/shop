<?php

class Document {

    private $documentId;

    public function initDocument($description) {
        $query = "INSERT INTO accounting_document SET description='$description' ";
        Db::get()->query($query);
        $this->documentId = Db::get()->insert_id;
    }

    public function addTransaction($debtorId, $creditorId, $amount, $debtorDescription, $creditorDescription) {
        Db::get()->query("START TRANSACTION");

        $query = "INSERT INTO accounting_transaction SET document_id=$this->documentId, "
                . "debtor_id=$debtorId, creditor_id=$creditorId, amount=$amount,"
                . "debtor_description='$debtorDescription', creditor_description='$creditorDescription'";
        Db::get()->query($query);
        $id = Db::get()->insert_id;
        $this->applyBalance($debtorId, -$amount);
        $this->applyBalance($creditorId, $amount);
        $query2 = "UPDATE accounting_transaction SET "
                . "debtor_balance=(SELECT balance FROM accounting_balance WHERE user_id=$debtorId), "
                . "creditor_balance=(SELECT balance FROM accounting_balance WHERE user_id=$creditorId)"
                . "WHERE id=$id";
        ;
        Db::get()->query($query2);
        Db::get()->query("COMMIT;");
    }

    private function applyBalance($userId, $amount) {
        $query = "UPDATE accounting_balance SET balance=balance+$amount WHERE user_id=$userId";
        Db::get()->query($query);
        if (Db::get()->affected_rows == 0 && $amount != 0) {
            $query = "INSERT INTO accounting_balance SET balance=$amount, user_id=$userId";
            Db::get()->query($query);
        }
    }

}
