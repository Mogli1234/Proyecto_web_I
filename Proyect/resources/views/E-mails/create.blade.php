@extends('layouts.app')
    @section('content')
        <form  class="form-horizontal" role="form" method="POST" action="/user">
            <h1>Register Form</h1>
            <div>
                <label>Nombre Completo</label>
                <input type="text" class="form-control required" name="name"/>
            </div>
            <div>
                <label>Correo Electronico</label>
                <input type="email" class="form-control required" placeholder="example@gmail.com" name="email">
            </div>
            <div>
                <label>Contraseña</label>
                <input type="password" class="form-control required" name="password">
            </div>
            <div>
                <div class="checkbox" >
                    <label><input type="checkbox"  name="rol">Administrador</label>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-default">Crear Usuario</button>
                <a href="/user"><input type="button" class="btn btn-default" value="Cancelar"></a>
            </div>
            <div class="clearfix"></div>
        </form>
    @stop