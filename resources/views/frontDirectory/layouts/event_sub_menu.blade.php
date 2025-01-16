<div class="container-fluid py-2 d-lg-block ">
    <div class="container">
        <div class="row">
            <div class="submenu-container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center text-lg-start">
                            <div class="submenu">
                                <a href="{{ url('/Breastbdcon2024') }}">BREASTBDCON 2025</a>
                                <span>|</span>
                                <a href="{{ url('/internationalFaculty') }}">International Faculty</a>
                                <span>|</span>
                                <a href="{{ url('/scientificSession') }}">Scientific Session</a>
                                <span>|</span>
                                <a href="{{ url('/invitation') }}">Invitation</a>
                                <span>|</span>
                                <a href="{{ url('/registration') }}">Registration</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .submenu-container {
        background-color: #d0d0d0; /* Light gray background */
        padding: 10px 0;
        margin-top: 20px;
    }

    .submenu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }

    .submenu a {
        text-decoration: none;
        color: #333; /* Bootstrap primary color */
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .submenu a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .submenu span {
        color: #6c757d; /* Bootstrap secondary text color */
        font-size: 18px;
    }

    @media (min-width: 992px) {
        .submenu {
            justify-content: flex-start;
        }
    }
</style>


