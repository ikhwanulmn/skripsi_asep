<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signin extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('isLoggedIn') == TRUE) {
            return redirect()->to(base_url('home'));
        } else {
            helper(['form']);
            echo view('signin');
        }
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $userModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('home'));
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to(base_url('signin'));
            }
        } else {
            $session->setFlashdata('msg', 'Check again your email or password');
            return redirect()->to(base_url('signin'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('home'));
    }
}
