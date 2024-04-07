<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],
            'password' => [
                'required',
                'string',
                'min:9',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{9,}$/',
            ],
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => [
                'required',
                'regex:/^84[1-9]\d{8}$/',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Trường tên phải là một chuỗi.',
            'name.max' => 'Trường tên không được vượt quá 255 ký tự.',
            'email.required' => 'Trường email là bắt buộc.',
            'email.email' => 'Email phải có định dạng hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'password.required' => 'Trường mật khẩu là bắt buộc.',
            'password.string' => 'Trường mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất 9 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết thường, một chữ cái viết hoa, một số và một ký tự đặc biệt.',
            'avatar.required' => 'Trường avatar là bắt buộc.',
            'avatar.image' => 'Avatar phải là một tệp hình ảnh.',
            'avatar.mimes' => 'Avatar phải là định dạng jpeg, png, jpg hoặc gif.',
            'avatar.max' => 'Kích thước tệp avatar không được vượt quá 2MB.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập đúng định dạng số điện thoại Việt Nam.',
        ];
    }
}
