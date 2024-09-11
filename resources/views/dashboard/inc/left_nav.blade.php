                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu tree" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              {{ __('Dashboard') }} 
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th" style="font-size: 26px;"></i>
                           <p>
                              Application Setup
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{ route('employee.index') }}" :active="request()->routeIs('employee.index'" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Users</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th" style="font-size: 26px;"></i>
                           <p>
                             Company 
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="{{ route('company.index') }}" :active="request()->routeIs('Company.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Company Profile</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item menu-is-opening menu-open">
                        
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-th" style="font-size: 26px;"></i>
                           <p>
                              {{ __('Masters') }}
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{ route('role-manager.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Role Permission') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('categories.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Categories') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('department.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Department') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('designation.index') }}" :active="request()->routeIs('designation.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Designation') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('country.index') }}" :active="request()->routeIs('country.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Country') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('state.index') }}" :active="request()->routeIs('state.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('State') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('city.index') }}" :active="request()->routeIs('city.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('City') }}</p>
                              </a>
                           </li>

                        </ul>
                     </li>

                     
                  </ul>
               </nav>