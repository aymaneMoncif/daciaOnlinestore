@extends('layout')

@section('headScript')
    <script type="text/javascript" src="{{asset('scripts/api/tramegatewaynapsv4.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/api/jsencrypt.js')}}"></script>

    <style>
        .popUp_commandeValid {
            width: 95%;
            margin: auto;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            padding: 0px;
            position: absolute;
            left: 3%;
            top: 25%;
            background-image: url(http://localhost:8000/storage/settings/April2024/j8z6q2JmIrHQQli5SAYf.jpg);
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-size: contain;
        }
        .rightSideContent {
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .rightSide {
            border: 1px solid var(--gray2);
            padding: 10px;
            height: 660px;
            width: 44%;
            background-color: white;
        }
        .close {
            text-align: right;
            margin-bottom: 0px;
            margin-right: 0px;
        }
    </style>
@stop

@section('popUp')
<!-------------------------------------------------------->
<div class="overlay"></div>
<div class="popUp_commandeValid">

    <div class="content">

        <div class="leftSide">

        </div>


        <div class="rightSide">
            <div class="close">
                <a href="/">X</a>
            </div>
            <div class="rightSideContent">

                <div class="typeVirement_cont">

                    <p class="Main_sous-title">
                        Se connecter
                    </p>

                    <!--/*  loader */-->
                    <div class="dot-spinner" id="loader" style="display: none">
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                        <div class="dot-spinner__dot"></div>
                    </div>
                    <!--/*  loader */-->

                    <!--@if(Auth::guard('client')->check())
                        <p>yees</p>
                    @else
                        <p>nooo</p>
                    @endif-->

                    <!--/*  VIREMENT / VERSEMENT */-->
                    <form method="post" action="{{ route('loginUser') }}">
                        @csrf

                        <input type="email" name="email" placeholder="email">
                        <input type="password" name="password" placeholder="password">

                        <br>
                        @error('email')
                            <p class="text-danger" style="color: #ff0000bf;font-family: 'NouvelRRegular';font-size:13px;">{{ $message }}</p>
                        @enderror
                        <button class="EnvoyerBTN" type="submit">Login</button>
                    </form>
                    <!--/*  VIREMENT / VERSEMENT END */-->

                </div>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script src={{ asset('scripts/myscript.js') }}></script>

@stop
