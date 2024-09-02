<?php

namespace App\Filament\Auth;

use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Login as AuthLogin;
use Filament\Http\Responses\Auth\LoginResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Login extends AuthLogin
{
    public function mount(): void
    {
        parent::mount();

        if(app()->environment('local')){
            $this->form->fill([
                'name' => 'yourname',
                'password' => '',
                'remember' => false,
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                $this->getLoginFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }
 
    protected function getLoginFormComponent(): Component 
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    } 

    protected function getCredentialsFromFormData(array $data): array
    {
        $login_type = 'name';
 
        return [
            $login_type => $data['login'],
            'password'  => $data['password'],
        ];
    }


}