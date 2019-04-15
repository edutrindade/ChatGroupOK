import { ChatGroup } from './../../app/model';
import { Component } from '@angular/core';
import { FirebaseAuthProvider } from '../../providers/auth/firebase-auth';

@Component({
  selector: 'chat-group-list',
  templateUrl: 'chat-group-list.html'
})
export class ChatGroupListComponent {

  //text: string;

  groups: ChatGroup[] = [];

  constructor(private firebaseAuth: FirebaseAuthProvider) {
  }

  ngOnInit(){
    const database = this.firebaseAuth.firebase.database();
    database.ref('chat_groups').on('child_added', (data) =>{
        const group = data.val() as ChatGroup;
        this.groups.push(group);
    });

    database.ref('chat_groups').on('child_changed', (data) =>{
        const group = data.val() as ChatGroup;
        const index = this.groups.findIndex((g)=> g.id == group.id);
        if (index!==-1) {
          this.groups[index] = group;
        }
    });
  }

}
