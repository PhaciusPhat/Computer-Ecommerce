<?php
class Validate
{
    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validate_name($name)
    {
        if (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]{2,}$/", $name)) {
            return false;
        }
        return true;
    }

    public function validate_email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    public function validate_phone($phone)
    {
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            return false;
        }
        return true;
    }

    public function validate_number($number)
    {
        if (!preg_match('/^[0-9]+$/', $number)) {
            return false;
        }
        return $number < 0 ? false : true;
    }

    public function validate_price($price)
    {
        if (!preg_match('/^[0-9]{1,}+$/', $price)) {
            return false;
        }
        return true;
    }

    public function validate_address($address)
    {
        if (!preg_match("/^.{10,}+$/", $address)) {
            return false;
        }
        return true;
    }

    public function validate_username($username)
    {
        if (!preg_match("/^[a-zA-Z0-9]{6,}$/", $username)) {
            return false;
        }
        return true;
    }

    public function validate_password($password)
    {
        if (!preg_match("/^.{6,}+$/", $password)) {
            return false;
        }
        return true;
    }

    public function validate_image($image)
    {

        // if (
        //     $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        //     && $imageFileType != "gif"
        // ) {
        //     return false;
        // }
        return true;
    }
}
