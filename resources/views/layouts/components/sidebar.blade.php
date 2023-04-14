         <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li>
                        <a href="{{ url('/dashboard') }}" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <?php if(session('role')=='admin') { ?>
                        <li>
                            <a href="{{ url('/instruktur') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-user-2"></i>
                                <span class="nav-text">Instruktur</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/member') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-id-card"></i>
                                <span class="nav-text">Member</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(session('role')=='kasir') { ?>
                        <li>
                            <a href="{{ url('/member') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-id-card"></i>
                                <span class="nav-text">Member</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if(session('role')=='manager') { ?>
                        <li>
                            <a href="{{ url('/jadwaldef') }}" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-calendar"></i>
                                <span class="nav-text">Jadwal Default</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
				<div class="copyright">
				</div>
			</div>
        </div>
        