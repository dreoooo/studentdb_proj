<?php
declare(strict_types=1);

class RegisterController {
    private UserModel $userModel;
    public string $msg = "";

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function handle(array $post): void {
        $username = trim($post['username'] ?? '');
        $email = trim($post['email'] ?? '');
        $password = trim($post['password'] ?? '');
        $confirmPassword = trim($post['confirm_password'] ?? '');

        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $this->msg = "❌ Please fill in all fields!";
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->msg = "❌ Invalid email format!";
            return;
        }

        if (!$this->isValidPassword($password)) {
            $this->msg = "❌ Password must have at least 8 characters, including uppercase, lowercase, and a number.";
            return;
        }

        if ($password !== $confirmPassword) {
            $this->msg = "❌ Passwords do not match!";
            return;
        }

        if ($this->userModel->getUserByUsername($username)) {
            $this->msg = "❌ Username is already taken!";
            return;
        }

        if ($this->userModel->getUserByEmail($email)) {
            $this->msg = "❌ Email is already registered!";
            return;
        }

        $this->userModel->createUser($username, $email, $password);
        $this->msg = "✅ Registration successful!";
    }

    private function isValidPassword(string $password): bool {
        return strlen($password) >= 8 &&
            preg_match('/[A-Z]/', $password) &&
            preg_match('/[a-z]/', $password) &&
            preg_match('/[0-9]/', $password);
    }
}
