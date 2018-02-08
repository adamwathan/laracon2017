## Cruddy by Design

During my talk at Laracon 2017, I shared some strategies I use to split large controllers into multiple small controllers.

The core idea is to try and stick to the 7 standard REST/CRUD actions in your controllers:

- Index
- Show
- Create
- Store
- Edit
- Update
- Destroy

Using this convention as a "rule" is a good way to force yourself to keep your controllers from becoming bloated, and can often lead to learning interesting new things about your domain.

For the presentation, I put together a demo app called "CastHacker" that showcases podcasts about software development. It's not a "real" app by any means (lots of imaginary features, no tests, etc.); it's just enough code to demonstrate the concepts from the presentation. Feel free to clone it and play with it locally if you like though.

![](https://pbs.twimg.com/media/DFN7pwiU0AE-qPG.jpg:large)

I've written up each refactoring I shared in the presentation as a detailed pull request:

1. [Give nested resources a dedicated controller](https://github.com/adamwathan/laracon2017/pull/1)

2. [Treat properties edited independently as separate resources](https://github.com/adamwathan/laracon2017/pull/2)

3. [Treat pivot models as their own resource](https://github.com/adamwathan/laracon2017/pull/3)
4. [Think of different states as different resources](https://github.com/adamwathan/laracon2017/pull/4)
