

<p for="email">Role : {{ $role->id }} - {{ $role->name }}</p>
<label for="email">Role s' Permissions :</label>
<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">name</th>
        </tr>
        </thead>

        <tbody>

        @foreach($listPermis as $permi)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $permi->id }}</td>
                <td>{{ $permi->name }}</td>

            </tr>
        @endforeach

        </tbody>
    </table>
</div>





