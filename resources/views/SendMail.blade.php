<div style=" width:500px;
    margin: 0 auto;
    padding: 15px;
    text-align: center">	
    <h2>Chào {{$user->hoten}}</h2>
    <p>Xác nhận cập nhật mật khẩu 
    <a href ="{{ route('mat-khau-moi',['id'=>$user->id]) }}">
	    Tại Đây
	</a> 
    </p>
</div>