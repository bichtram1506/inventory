import axios from 'axios';
// Đặt mã CSRF token vào tiêu đề yêu cầu mặc định của Axios
axios.defaults.headers.common['X-CSRF-Token'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');