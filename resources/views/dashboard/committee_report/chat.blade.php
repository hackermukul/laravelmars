<?php
// Set the filename for the Excel download
$filename = "chat_listing-List-" . date('d-m-Y') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Data Listing List</title>
   </head>
   <body>
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
         <thead>
            @if(!empty($start_date) || !empty($end_date))
               <tr>
                  <th colspan="8" style="background-color:#CCC; text-align:center;">
                     <br />Search Record:
                     @if(!empty($start_date)) From: {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} @endif
                     @if(!empty($end_date)) To: {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }} @endif
                     <br />&nbsp;
                  </th>
               </tr>
            @endif
            <tr>
               <th style="background-color:#999">Sl. No.</th>
               <th style="background-color:#999">Grievance ID</th>
               <th style="background-color:#999">Customer Name</th>
               <th style="background-color:#999">Subject</th>
                              <th style="background-color:#999">reply</th>

               
               <th style="background-color:#999">Related To</th>
               <th style="background-color:#999">Added On</th>
               <th style="background-color:#999">Status</th>
            </tr>
         </thead>
         <tbody>
            @php($count = 0)
            @foreach ($data_listing as $row)
               @php($count++)
               <tr>
                  <td>{{ $count }}</td>
                  <td>{{ !empty($row->id) ? $row->id : 'N/A' }}</td>
                  <td>{{ !empty($row->customer_name) ? $row->customer_name : 'N/A' }}</td>
                  <td>{{ !empty($row->subject) ? $row->subject : 'N/A' }}</td>
                    <td>{{ !empty($row->reply) ? $row->reply : 'N/A' }}</td>

                  <td>{{ !empty($row->related_to) ? $row->related_to : 'N/A' }}</td>
                  <td>{{ !empty($row->created_at) ? \Carbon\Carbon::parse($row->created_at)->format('M d/Y') : 'N/A' }}</td>
                  <td>
                     @switch($row->sts)
                        @case(1)
                           <span class="badge badge-success">
                              <i class="fas fa-check"></i> In Process
                           </span>
                           @break
                        @case(0)
                           <span class="badge badge-danger">
                              <i class="fas fa-ban"></i> Pending
                           </span>
                           @break
                        @case(2)
                           <span class="badge badge-warning">
                              <i class="fas fa-archive"></i> Closed
                           </span>
                           @break
                        @default
                           <span class="badge badge-secondary">Unknown</span>
                     @endswitch
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </body>
</html>
