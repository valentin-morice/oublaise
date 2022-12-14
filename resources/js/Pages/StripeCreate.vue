<template>
    <div class="hero min-h-screen bg-base-200">
        <form
            id="payment-form"
            class="bg-white block mx-auto my-8"
            @submit.prevent="submit"
        >
            <h1 class="font-bold text-xl text-gray-700 mb-2">
                Payer Maintenant
            </h1>
            <p>Merci, {{ donation.first_name + " " + donation.last_name }}.</p>
            <p class="mb-4">
                Votre Donation: €{{ displayAmount(donation.amount) }}
            </p>
            <div id="payment-element">
                <!--Stripe.js injects the Payment Element-->
            </div>
            <button id="submit">
                <div id="spinner" class="spinner hidden"></div>
                <span id="button-text">Payer</span>
            </button>
            <div id="payment-message" class="hidden"></div>
        </form>
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";
import Base from "./Layout/Base";

export default {
    layout: Base,
    components: {
        Link,
    },
    data() {
        return {
            elements: null,
            stripe: Stripe(this.donation.stripePK),
        };
    },
    props: ["donation"],
    mounted() {
        const donation = {
            amount: this.donation.amount,
            first_name: this.donation.first_name,
            last_name: this.donation.last_name,
            email: this.donation.email,
            stripePK: this.donation.stripePK,
            project: this.donation.project
        };
        initialize();
        checkStatus();

        let vm = this;

        // Fetches a payment intent and captures the client secret
        async function initialize() {
            const {clientSecret} = await fetch("/stripe/create", {
                method: "POST",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(donation),
            }).then((r) => r.json());

            vm.elements = vm.stripe.elements({clientSecret});

            const paymentElement = vm.elements.create("payment");
            paymentElement.mount("#payment-element");
        }

        // Fetches the payment intent status after payment submission
        async function checkStatus() {
            const clientSecret = new URLSearchParams(
                window.location.search
            ).get("payment_intent_client_secret");

            if (!clientSecret) {
                return;
            }

            const {paymentIntent} = await vm.stripe.retrievePaymentIntent(
                clientSecret
            );

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage(
                        "Your payment was not successful, please try again."
                    );
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }
    },
    methods: {
        displayAmount(amount) {
            if (this.countDecimals(amount) === 2) {
                return amount;
            } else if (this.countDecimals(amount) === 1) {
                return amount + "0";
            } else if (this.countDecimals(amount) === 0) {
                return amount + ".00";
            }
        },
        countDecimals(value) {
            if (Math.floor(value) === value) return 0;
            return value.toString().split(".")[1].length || 0;
        },
        showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        },
        setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document
                    .querySelector("#button-text")
                    .classList.remove("hidden");
            }
        },
        getElements() {
            return this.elements;
        },
        submit() {
            const vm = this;

            async function handleSubmit() {
                vm.setLoading(true);
                const elements = vm.getElements();

                const mail = vm.donation.email;

                const {error} = await vm.stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        // Make sure to change this to your payment completion page
                        return_url:
                            window.location.protocol +
                            "//" +
                            window.location.host +
                            "/" +
                            "stripe/success",
                        receipt_email: mail,
                    },
                });

                // This point will only be reached if there is an immediate error when
                // confirming the payment. Otherwise, your customer will be redirected to
                // your `return_url`. For some payment methods like iDEAL, your customer will
                // be redirected to an intermediate site first to authorize the payment, then
                // redirected to the `return_url`.
                if (
                    error.type === "card_error" ||
                    error.type === "validation_error"
                ) {
                    vm.showMessage(error.message);
                } else {
                    vm.showMessage("An unexpected error occurred.");
                }

                vm.setLoading(false);
            }

            handleSubmit();
        },
    },
};
</script>

<style scoped>
/* Variables */
* {
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 16px;
    -webkit-font-smoothing: antialiased;
    display: flex;
    justify-content: center;
    align-content: center;
    height: 100vh;
    width: 100vw;
}

form {
    width: 30vw;
    min-width: 500px;
    align-self: center;
    box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1),
    0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
    border-radius: 7px;
    padding: 40px;
}

.hidden {
    display: none;
}

#payment-message {
    color: rgb(105, 115, 134);
    font-size: 16px;
    line-height: 20px;
    padding-top: 12px;
    text-align: center;
}

#payment-element {
    margin-bottom: 24px;
}

/* Buttons and links */
button {
    background: #5469d4;
    font-family: Arial, sans-serif;
    color: #ffffff;
    border-radius: 4px;
    border: 0;
    padding: 12px 16px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: block;
    transition: all 0.2s ease;
    box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
    width: 100%;
}

button:hover {
    filter: contrast(115%);
}

button:disabled {
    opacity: 0.5;
    cursor: default;
}

/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
    border-radius: 50%;
}

.spinner {
    color: #ffffff;
    font-size: 22px;
    text-indent: -99999px;
    margin: 0px auto;
    position: relative;
    width: 20px;
    height: 20px;
    box-shadow: inset 0 0 0 2px;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
}

.spinner:before,
.spinner:after {
    position: absolute;
    content: "";
}

.spinner:before {
    width: 10.4px;
    height: 20.4px;
    background: #5469d4;
    border-radius: 20.4px 0 0 20.4px;
    top: -0.2px;
    left: -0.2px;
    -webkit-transform-origin: 10.4px 10.2px;
    transform-origin: 10.4px 10.2px;
    -webkit-animation: loading 2s infinite ease 1.5s;
    animation: loading 2s infinite ease 1.5s;
}

.spinner:after {
    width: 10.4px;
    height: 10.2px;
    background: #5469d4;
    border-radius: 0 10.2px 10.2px 0;
    top: -0.1px;
    left: 10.2px;
    -webkit-transform-origin: 0px 10.2px;
    transform-origin: 0px 10.2px;
    -webkit-animation: loading 2s infinite ease;
    animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes loading {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@media only screen and (max-width: 600px) {
    form {
        width: 95vw;
        padding: 20px;
        min-width: initial;
    }
}
</style>
