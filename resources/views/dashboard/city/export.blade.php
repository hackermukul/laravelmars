<?php
   $filename = "categories-List-" . date('d-m-Y') . ".xls"; header("Content-Disposition: attachment; filename=\"$filename\""); 
   header("Content-Type: application/vnd.ms-excel");

   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>categories List</title>
   </head>
   <body>
      
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
         <thead>
            @if(!empty($start_date) || !empty($end_date))
            <tr>
               <th  colspan="{{ 5 }}" style="background-color:#CCC" width="*"><br />
                  Search Record : 
                  @if(!empty($start_date)) {{ "From : ".date('d-m-Y' , strtotime($start_date)); }}  @endif
                  @if(!empty($end_date))  {{  "	To : ".date('d-m-Y' , strtotime($end_date)); }} @endif
                  <br />&nbsp;
               </th>
            </tr>
            @endif
            <tr >
               <th style="background-color:#999" width="*">Sl. No.</th>
               <th style="background-color:#999" width="*">Name</th>
               <th style="background-color:#999" width="*">Added On</th>
               <th style="background-color:#999" width="*">Added By</th>
               <th style="background-color:#999" width="*">Status</th>
            </tr>
         </thead>
          @if(!empty($categories))
                           <tbody>
                           @php($count=0)
                            @foreach ($categories as $row) @php($count++)
                              <tr>
                                 <td>{{$count}}</td>
                                
                                 <td>@if(!empty($row->name)){{$row->name}} @else {{'N/A'}} @endif</td>
                                 <td>@if(!empty($row->created_at)) {{ date('M d/Y', strtotime($row->created_at)) }}  @else {{'N/A'}} @endif</td>
                                 <td>@if(!empty($row->added_by)){{$row->added_by}} @else {{'N/A'}} @endif</td>
                                 <td>
                                 @if($row->status ==1)
                                   {{ __('Active') }}
                                    @else
                                    {{ __('Block') }}
                                 @endif
                                 </td>
                              </tr>
                               @endforeach
                           </tbody>
                        @endif

              </table>
   </body>
</html>