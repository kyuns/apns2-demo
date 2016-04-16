package main

import (
	apns "github.com/sideshow/apns2"
	"github.com/sideshow/apns2/certificate"
	"log"
)

func main() {

	cert, pemErr := certificate.FromPemFile("Your Cert", "")
	if pemErr != nil {
		log.Println("Cert Error:", pemErr)
	}

	notification := &apns.Notification{}
	notification.DeviceToken = "Your Device Token"
	notification.Topic = "You App Bundle"
	notification.Payload = []byte(`{"aps":{"alert":"Hello!"}}`)

	log.Println(notification)
	//client := apns.NewClient(cert).Development()
	client := apns.NewClient(cert).Production()
	res, err := client.Push(notification)

	if err != nil {
		log.Println("APNS Error: ", err)
		return
	}

	log.Println(res)
}
