 <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('profile') }}" class="text-decoration-none">Profile Overview</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('editProfile') }}" class="text-decoration-none">Edit Profile</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('changePassword') }}" class="text-decoration-none">Change Password</a>
                        </li>
                       <li class="list-group-item">
                            <a href="#grievance-tab" data-bs-toggle="tab" class="text-decoration-none">Grievance</a>
                            <ul class="list-group mt-2">
                                <li class="list-group-item {{ request()->routeIs('addGrievance') ? 'active' : '' }}">
                                    <a href="{{ route('addGrievance') }}" class="text-decoration-none">Add Grievance</a>
                                </li>
                                <li class="list-group-item {{ request()->routeIs('viewGrievance') ? 'active' : '' }}">
                                    <a href="{{ route('viewGrievance') }}" class="text-decoration-none">View Grievance</a>
                                </li>
                            </ul>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="text-decoration-none text-danger">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>