@extends('layouts.app')

@section('main')
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-xl-5 col-xxl-12 mr-auto">
								<div class="d-sm-flex d-block align-items-center">
									<img src="{{ asset('/theme/images/illustration.png') }}" alt="" class="mw-100 mr-3">
									<div>
										<h4 class="fs-20 text-black">Selamat Datang {{ session('nama') }} </h4>
										<p class="fs-14 mb-0">Selamat datang di dalam aplikasi GoFit</p>
									</div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	
@endsection
