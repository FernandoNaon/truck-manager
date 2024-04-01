<template>
    <div class="background-container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <template v-if="selectedUser">
                    <p>$ {{ selectedUser?.cash }}</p>
                    <p>{{ selectedUser?.name }}</p>
                </template>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a
                            class="nav-link"
                            @click="selectUser(user)"
                            aria-current="page"
                            href="#"
                            >Users</a
                        >
                        <a
                            v-if="selectedUser"
                            class="nav-link"
                            @click="closeMyVehicles()"
                            >Purchase Trucks</a
                        >
                        <a
                            v-if="selectedUser"
                            class="nav-link"
                            @click="getMyVehicles()"
                            >My trucks</a
                        >
                    </div>
                </div>
            </div>
            <div id="alertContainer"></div>
        </nav>
        <!-- all users -->
        <div class="container mt-4">
            <template v-if="!selectedUser && !showMyVehicles">
                <h3>Select a user:</h3>
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="user in users"
                        :key="user.id"
                        @click="selectUser(user)"
                    >
                        {{ user.name }}
                    </li>
                </ul>
            </template>
        </div>
        <!-- vehicles available -->
        <template v-if="selectedUser && !showMyVehicles">
            <div class="filter">
                <p class="mr-3 mb-0">Max price:</p>
                <input
                    v-model="maxPrice"
                    type="number"
                    class="form-control"
                    id="maxPrice"
                    placeholder="Enter max price"
                />
                <button @click="filterByPrice()" class="btn btn-primary">
                    Filter
                </button>
            </div>

            <div
                class="cards-container"
                v-for="item in vehicles"
                :key="item.id"
                v-if="vehicles.length"
            >
                <div class="card mb-4" style="width: 18rem">
                    <img
                        class="card-img-top"
                        :src="getTruckImage(item.name)"
                        alt="Card image cap"
                    />
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ formatTruckName(item.name) }}
                        </h5>
                        <div class="truck-data">
                            <p>Speed: {{ item.speed }}/5</p>
                            <p>Acceleration: {{ item.acceleration }}/5</p>
                            <p>Fuel consumption: {{ item.fuel_cons }}/5</p>
                            <p class="card-text">Price: ${{ item.price }}</p>
                        </div>
                        <a
                            href="#"
                            class="btn btn-primary mt-2"
                            @click="buyVehicle(item)"
                            >Buy</a
                        >
                    </div>
                </div>
            </div>
            <div class="table--items" v-else>
                <p>No trucks to show</p>
            </div>
        </template>
        <!-- my vehicles -->
        <template v-if="showMyVehicles">
            <div
                class="cards-container"
                v-for="item in myVehicles"
                :key="item.id"
                v-if="myVehicles.length"
            >
                <div class="card mb-4" style="width: 18rem">
                    <img
                        class="card-img-top"
                        :src="getTruckImage(item.name)"
                        alt="Card image cap"
                    />
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ formatTruckName(item.name) }}
                        </h5>
                        <div class="truck-data">
                            <p>Speed: {{ item.speed }}/5</p>
                            <p>Acceleration: {{ item.acceleration }}/5</p>
                            <p>Fuel consumption: {{ item.fuel_cons }}/5</p>
                            <p class="card-text">Price: ${{ item.price }}</p>
                        </div>
                        <a
                            href="#"
                            class="btn btn-primary mt-2"
                            @click="sellVehicle(item)"
                            >Sell</a
                        >
                    </div>
                </div>
            </div>
            <div class="table--items" v-else>
                <p>No trucks to show</p>
            </div>
        </template>
        <!--  -->
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import axios from "axios";
import ThunderHauler from "../../../public/images/ThunderHauler.png";
import ApexTruck from "../../../public/images/ApexTruck.png";
import TitanRoadmaster from "../../../public/images/TitanRoadmaster.png";
import MegaMover from "../../../public/images/MegaMover.png";
import BlazeRunner from "../../../public/images/BlazeRunner.png";

const truckImages = {
    ThunderHauler: ThunderHauler,
    ApexTruck: ApexTruck,
    TitanRoadmaster: TitanRoadmaster,
    MegaMover: MegaMover,
    BlazeRunner: BlazeRunner,
};

const formatTruckName = (truckName) => {
    return truckName.replace(/(?<!^)(?=[A-Z])/g, " ");
};

export default {
    setup() {
        let users = ref([]);
        let selectedUser = ref(null);
        let vehicles = ref([]);
        let myVehicles = ref([]);
        const showMyVehicles = ref(false);
        const maxPrice = ref(null);

        onMounted(async () => {
            getUsers();
            getVehicles();
        });

        const getUsers = async () => {
            try {
                let response = await axios.get("/api/users");
                users.value = response.data.users;
            } catch (error) {
                console.error("Error fetching users:", error);
            }
        };

        const selectUser = (user) => {
            selectedUser.value = user;
            showMyVehicles.value = false;
        };

        const getVehicles = async () => {
            try {
                let response = await axios.get("/api/vehicles");
                vehicles.value = response.data.vehicles.filter(
                    (vehicle) => vehicle.has_owner === 0
                );
            } catch (error) {
                console.error("Error fetching vehicles:", error);
            }
        };

        const getMyVehicles = async () => {
            try {
                let response = await axios.get(
                    `/api/user-vehicles/${selectedUser.value.id}`
                );
                myVehicles.value = response.data.user.vehicles;
                showMyVehicles.value = true;
            } catch (error) {
                console.error("Error fetching my vehicles:", error);
            }
        };

        const closeMyVehicles = () => {
            showMyVehicles.value = false;
            getVehicles();
        };

        const getTruckImage = (truckName) =>
            truckImages[truckName] || "../../../../public/images/truck.png";

        const buyVehicle = async (vehicle) => {
            try {
                if (selectedUser.value.cash >= vehicle.price) {
                    await axios.post("/api/user-vehicles/assign", {
                        user_id: selectedUser.value.id,
                        vehicle_id: vehicle.id,
                    });
                    await axios.put(`/api/vehicles/${vehicle.id}/buy-or-sell`, {
                        user_id: selectedUser.value.id,
                        has_owner: true,
                    });
                    const updatedCash = selectedUser.value.cash - vehicle.price;
                    selectedUser.value.cash = updatedCash;
                    await axios.put(
                        `/api/users/${selectedUser.value.id}/update-cash`,
                        {
                            cash: updatedCash,
                        }
                    );
                    await getVehicles();
                    showAlert("success", "Vehicle bought successfully!");
                } else {
                    showAlert(
                        "danger",
                        "Insufficient funds to buy the vehicle."
                    );
                }
            } catch (error) {
                console.error("Error buying vehicle:", error);
                showAlert(
                    "danger",
                    "Error buying vehicle. Please try again later."
                );
            }
        };

        const sellVehicle = async (vehicle) => {
            try {
                await axios.put(`/api/vehicles/${vehicle.id}/buy-or-sell`, {
                    user_id: null,
                    has_owner: false,
                });
                const updatedCash = selectedUser.value.cash + vehicle.price;
                selectedUser.value.cash = updatedCash;
                await axios.put(
                    `/api/users/${selectedUser.value.id}/update-cash`,
                    {
                        cash: updatedCash,
                    }
                );
                await getMyVehicles();
                showAlert("success", "Vehicle sold successfully!");
            } catch (error) {
                console.error("Error selling vehicle:", error);
                showAlert(
                    "danger",
                    "Error selling vehicle, Please try again later."
                );
            }
        };

        const showAlert = (type, message) => {
            const alertContainer = document.getElementById("alertContainer");
            const alert = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
            alertContainer.innerHTML = alert;
        };

        const filterByPrice = async () => {
            try {
                let response = await axios.get(
                    "/api/vehicles/filter-by-price",
                    {
                        params: {
                            max_price: maxPrice.value,
                        },
                    }
                );
                vehicles.value = response.data.vehicles;
            } catch (error) {
                console.error("Error filtering vehicles by price:", error);
            }
        };

        return {
            users,
            selectedUser,
            selectUser,
            vehicles,
            getTruckImage,
            myVehicles,
            showMyVehicles,
            formatTruckName,
            buyVehicle,
            getMyVehicles,
            closeMyVehicles,
            sellVehicle,
            maxPrice,
            filterByPrice,
        };
    },
};
</script>
