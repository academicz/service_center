<h2 style="text-align: center;">Enquiry from newvitra.com</h2>
<table style="width: 100%;text-align: center">
    <tr>
        <th>Name</th>
        <td>{{$contact->name}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $contact->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $contact->phone }}</td>
    </tr>
    <tr>
        <th>Subject</th>
        <td>{{ $contact->subject }}</td>
    </tr>
    <tr>
        <th>Message</th>
        <td>{{ $contact->message }}</td>
    </tr>
</table>